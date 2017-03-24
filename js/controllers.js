
angular.module("kanbanApp").controller("dashboardCtrl", function(taskFactory, $scope,$rootScope, $location, CloneObj, $timeout) {
  $scope.handleDrop = function(item, bin) {
    taskFactory.updateTask(item,bin).then(function(data) {
            //$scope.data = data;
           // $location.url("/dashboard");
           //console.log(item,bin);
        }, function(err) {
          //  echo(err);
        }) ;
  }
   $rootScope.logged=false;
    //todo  a7el moshkelet el delete a3raf anhy hadeleto
    $scope.deletetask = function(taskID,e) {
       // taskID = 20;
        taskFactory.deletetask(taskID).then(function(data) {
            $scope.data = data;
            
         $(e.target).parents("#"+taskID).remove();
            //$location.url("/dashboard");

        }, function(err) {
           // echo(err);
        });
    };

    $scope.getData = function(){
        taskFactory.getTasks().then(function successCallback(data) {
            $scope.todo = Array();
            $scope.inprogress = Array();
            $scope.testing = Array();
            $scope.done = Array();
            if (data == "failure") {
                $location.url("/forms");
                //console.log()
            }
           // console.log(data)
            for (var i = 0; i < data.length; i++) {
                if (data[i]['taskStatus'] == 'todo') {
                    $scope.todo.push(data[i]);
                } else if (data[i]['taskStatus'] == 'inprogress') {
                    $scope.inprogress.push(data[i]);
                } else if (data[i]['taskStatus'] == 'testing') {
                    $scope.testing.push(data[i]);
                } else if (data[i]['taskStatus'] == 'done') {
                    $scope.done.push(data[i]);
                }
            }

            $timeout(function(){
                $(".loader").addClass("hide");
            }, 750);
        }, function errorCallback(err) {

            console.log(err);
            $scope.dataerr = err;

        });
    };

    $scope.addTask = function(isvalid) {
        //console.log(isvalid);

        if (isvalid) {

            taskFactory.addtask($scope.newTask).then(function(data) {
                $scope.data = data;
                // $location.url("dashboard");
                $scope.getData();
                $("#taskModal").modal("hide");
                $("#addtask")[0].reset();
            }, function(err) {
                echo(err);
            });
        }

        //  $location.url("/getTasks");
    }

    $scope.editTask = function(isvalid, task) {
        //isvalid
        //if(isvalid){
        //$scope.editTaskform = { taskId: 32, name: "task16", Desc: "task6666", dueDate: '2017-09-09', status: "testing", priority: 2 };
        taskFactory.editTask(task).then(function(data) {
            $scope.data = data;
            //$location.url("dashboard");
            $scope.getData();
            $("#editModal").modal("hide");
        }, function(err) {
            echo(err);
        });
        //}
    };

    // $scope.close = function(name,flag) {
    //     $('#' + name).modal('hide');
    // };

    $scope.pushmodal = function(task) {
        CloneObj.newObj(task).then(function(obj){
            $scope.editedtask = obj;
        });
    }
        
    $scope.close = function(name, flag) {
        $('#' + name).modal('hide');
    };
    


});


angular.module('kanbanApp').controller('forms', function($scope, $rootScope, $location, User) {
    //console.log("Hi");

    //console.log(addUser.x);
    $rootScope.logged=true;
    
    //console.log($rootScope.logged);
    $scope.signup = function(isValid) {
        if (isValid) {
            User.signup($scope.user).then(
                function(res) {
                    console.log(res);
                    if (res == "success") {

                        $rootScope.logged=false;
                        $location.url('/dashboard');
                    } else if (res == "failure") {
                        $location.url('/forms');
                    }
                },
                function(err) {
                    console.log(err);
                })


        }
    }
    
    //$scope.log_flag = false;
    $scope.login = function(isValid) {
        if (isValid) {
            User.login($scope.regEmail, $scope.regPassword).then(
                function(res) {
                    //$scope.userID=res.data;
                    console.log(res);
                    if (res == "success") {
                      //  $scope.log_flag = true;

                        $rootScope.logged=false;
                        $location.url('/dashboard');
                    } else if (res == "failure") {
                        $location.url('/forms');
                    }
                    //console.log("your id is "+$scope.userID);

                },
                function(err) {
                    console.log(err);
                })
        }

    }
    $scope.signout = function(){
        User.signout().then(
            function(res){
                $rootScope.logged=true;

                $location.url('/forms');
            })   
    }
});
angular.module('kanbanApp').controller('profileCtrl', function($scope, $rootScope, $location, User, CloneObj) {
    // function newObj(obj) {
    //     var newObj = new Object();
    //     angular.forEach(obj, function(value, key) {
    //         newObj[key] = value;
    //     });

    //     return newObj;
    // };

  //  $scope.profile = {};

   $rootScope.logged=false;
   $scope.pass="";
    User.profile().then(
        function(res) {
            // console.log(res);
            if (res == "failure") {
                $location.url('/forms');
            } else {
                $scope.profile = res;
                
                for(var i=0;i<$scope.profile['password'].length;i++)
                {
                    $scope.pass+="*";
                }
                //console.log($scope.pass);
                CloneObj.newObj(res).then(function(obj){
                    $scope.original = obj;
                });
            }

            //console.log($scope.profile);
        },
        function(err) {
            console.log(err);
        });
    //$scope.user=$scope.profile;
    $scope.edituser = function(isvalid, formData) {
        console.log(formData);
        if (isvalid) {

                $scope.pass="";
                for(var i=0;i<formData['password'].length;i++)
                {
                    $scope.pass+="*";
                }
                console.log($scope.pass);
            User.edituser(formData).then(
                function(res) {
                    if (res == "success") {
                        //console.log($scope.profile);
                        //$scope.close("myModal",false); sa7aa77
                        // $location.url('profile');
                    } else if (res == "failure") {
                        $location.url('forms');
                    }

                    //console.log($scope.profile);
                },
                function(err) {
                    console.log(err);
                });
            //todo ab3at el user dah 3lshan a3ml update
            //user
        }
    };

    $scope.close = function(name, flag) {
        if(flag) {
            CloneObj.newObj($scope.original).then(function(obj){
                $scope.profile = obj;
            });
        } else {
           CloneObj.newObj($scope.profile).then(function(obj){
                $scope.original = obj;
            });
        }
        
        $('#' + name).modal('hide');
    };


});