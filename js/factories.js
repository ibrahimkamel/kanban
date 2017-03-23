angular.module("kanbanApp").factory("taskFactory", function($http, $q) {
    return {
        getTasks: function() {
            $(".loader").removeClass("hide");
            var defer = $q.defer();
            $http({
                method: 'POST',
                url: './php/tasks/getalltasks.php'
            }).then(function successCallback(res) {
                defer.resolve(res.data);

            }, function errorCallback(err) {
                defer.reject(err.data);
            });

            return defer.promise;
        },
        addtask: function(newTask) {
            var deferred_data = $q.defer();
            $http({
                url: './php/tasks/addtask.php',
                method: 'POST',
                data: newTask

            }).then(function(res) {
                deferred_data.resolve(res.data);
                console.log('response', res);
            }, function(error) {
                deferred_data.reject(error);
                console.log('error', error);
            })
            return deferred_data.promise;
        },
        deletetask: function(taskID) {
            var deferred_data = $q.defer();
            $http({
                url: './php/tasks/deletetask.php',
                method: 'POST',
                data: taskID

            }).then(function(res) {
                deferred_data.resolve(res.data);
                console.log('response', res.data);
            }, function(error) {
                deferred_data.reject(error);
                console.log('error', error.data);
            })
            return deferred_data.promise;
        },
        editTask: function(taskID) {
            var deferred_data = $q.defer();
            $http({
                url: './php/tasks/edittask.php',
                method: 'POST',
                data: taskID

            }).then(function(res) {
                deferred_data.resolve(res.data);
            }, function(error) {
                deferred_data.reject(error);
                console.log('error', error.data);
            })
            
            return deferred_data.promise;
        },     updateTask: function(taskID,taskStatus) {
            var deferred_data = $q.defer();
            $http({
                url: './php/tasks/updatestatus.php',
                method: 'POST',
                data: {taskId:taskID,status :taskStatus}

            }).then(function(res) {
                deferred_data.resolve(res.data);
                console.log('response', res.data);
            }, function(error) {
                deferred_data.reject(error);
                console.log('error', error.data);
            })
            return deferred_data.promise;
        }

    }


});
angular.module('kanbanApp').factory('User', function($q, $http) {
    return {
        signup: function(user) {
            var defer = $q.defer();
            $http({
                method: 'POST',
                url: './php/users/signup.php',
                data: user
            }).then(function(res) {
                defer.resolve(res.data);
            }, function(err) {
                defer.reject(err.data);
            })
            return defer.promise;
        },
        edituser: function(user) {
            var defer = $q.defer();
            $http({
                method: 'POST',
                url: './php/users/editUser.php',
                data: user
            }).then(function(res) {
                defer.resolve(res.data);
            }, function(err) {
                defer.reject(err.data);
            })
            return defer.promise;
        },

        login: function(email, password) {
            var defer = $q.defer();
            $http({
                method: 'POST',
                url: './php/users/login.php',
                data: { userEmail: email, password: password }
            }).then(function(res) {
                defer.resolve(res.data);
            }, function(err) {
                defer.reject(err.data);
            })
            return defer.promise;
        },

        profile: function() {
            var defer = $q.defer();
            $http({
                method: 'POST',
                url: './php/users/selectUser.php'
            }).then(function(res) {
                defer.resolve(res.data);
            }, function(err) {
                defer.reject(err.data);
            })
            return defer.promise;
        },  

         signout: function(){
            var defer = $q.defer();
            console.log("hello");
            $http({
                method: 'POST',
                url: './php/users/signout.php'
            }).then(function(res) {
                defer.resolve(res.data);
                console.log(res.data);
            }, function(err) {
                defer.reject(err.data);
            })
            return defer.promise;


        }
    }
});

angular.module('kanbanApp').factory('CloneObj', function($q) {
    return {
        newObj: function(obj) {
            var defer = $q.defer(),
                newObj = new Object();

            angular.forEach(obj, function(value, key) {
                if(key !== "$$hashKey")
                    newObj[key] = value;
            });

            defer.resolve(newObj);
            return defer.promise;
        }
    }
});