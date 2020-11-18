var app = angular.module('metroSecours',
    ['ui.router', 'ngAnimate', 'ngSanitize', 'ngTouch', 'mOsCtrl', 'ngCookies']);

app.config(function ($stateProvider, $urlRouterProvider, $locationProvider) {

    $urlRouterProvider.otherwise("/");
    $locationProvider.html5Mode(true);
    $stateProvider
        .state('main', {
            controller: 'MainCtrl',
            url: "/",
            templateUrl: "assets/partials/main.html"
        })
        .state('main.signup', {
            controller: 'SignupCtrl',
            url: "signup",
            templateUrl: "assets/partials/form_connexion.html"
        })
        .state('main.signin', {
            controller: 'SigninCtrl',
            url: "signin",
            templateUrl: "assets/partials/form_inscription.html"
        })
        .state('profile', {
            controller: 'ProfileCtrl',
            templateUrl: "assets/partials/profile.html"
        })
        .state('profile.manage', {
            controller: 'ProfileEditCtrl',
            url: "/profile",
            templateUrl: "assets/partials/profile.manage.html"
        })
        .state('profile.fidelity', {
            controller: 'ChallengesCtrl',
            url: "/profile/challenges",
            templateUrl: "assets/partials/profile.challenges.html"
        })
        .state('contact', {
            controller: 'ContactCtrl',
            url: "/contact",
            templateUrl: "assets/partials/contact.html"
        });

});

app.run(['$rootScope', '$http', '$state', '$cookies', function ($rootScope, $http, $state, $cookies) {
    // $rootScope.rootUrl = "http://metrosecours.lan";
    $rootScope.rootUrl = "https://cen.metrosecours.amnesia.cafe";

    $rootScope.toCome = true;
    //Reconnexion auto, si l'utilisateur à choisi auparavant "Se souvenir de moi"
    var toLog = $cookies.getObject('remember');

    //-> Si un cookie est présent, on se reconnecte et récupère le profil utilisateur.
    if (toLog !== undefined) {
        toLog.isAuto = true;
        $http({
            method: "POST",
            url: $rootScope.rootUrl + "/php/connexion.php",
            data: $.param(toLog),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            }
        }).then(
            function (data) {
                if (data.data.success) {
                    console.log('Auto connect réussie');
                    $rootScope.loggedUser = data.data.user;
                    $rootScope.logged = true;
                }
                else {
                    console.log("Auto connect echec");
                }

            },
            function (data) {
                console.log("Auto connect echec");
            });
    }
    else {
        $rootScope.logged = false;
    }


    //deconnexion - reset des variables utilisateur et suppression des cookies
    $rootScope.logOut = function () {
        $rootScope.logged = false;
        $rootScope.loggedUser = undefined;
        $cookies.remove('remember');
        console.log("Logged Out -> Redirect");
        $state.go('main');
    }


    //Vérifie que l'utilisateur a bien les droits pour accéder à la page en question.
    $rootScope.$on('$stateChangeSuccess', function (event, toState, toStateParams) {
        // console.log(toState);
        //-> Variable determinant si la modal de connexion/inscription est ouverte.
        $rootScope.modalActive = ($state.current.name !== "main.signin" && $state.current.name !== "main.signup");

        if (!$rootScope.logged) {
            if (toState.name !== "main.signup" && toState.name !== "main"
                && toState.name !== "main.signin") {
                console.log("Redirecting to main, because not logged");
                $state.go('main');
            }
        }
        else {
            if (toState.name === "main.signup" || toState.name === "main.signin") {
                console.log("Redirecting to main, because already logged");
                $state.go('main');
            }
        }
    });
}]);

//TODO : Gestion de la carte intéractive
//Suivre tuto ici : http://blog.ippon.fr/2015/07/03/carte-svg-en-angularjs/
//Nettoyer le code et traduire les commentaires en anglais.
var ctrl = angular.module('mOsCtrl', []);








//http://deepinthecode.com/2014/08/05/converting-a-sql-datetime-to-a-javascript-date/
function DatetimeToJsDate(sqlDate){
    //sqlDate in SQL DATETIME format ("yyyy-mm-dd hh:mm:ss.ms")
    var sqlDateArr1 = sqlDate.split("-");
    //format of sqlDateArr1[] = ['yyyy','mm','dd hh:mm:ms']
    var sYear = sqlDateArr1[0];
    var sMonth = (Number(sqlDateArr1[1]) - 1).toString();
    var sqlDateArr2 = sqlDateArr1[2].split(" ");
    //format of sqlDateArr2[] = ['dd', 'hh:mm:ss.ms']
    var sDay = sqlDateArr2[0];
    var sqlDateArr3 = sqlDateArr2[1].split(":");
    //format of sqlDateArr3[] = ['hh','mm','ss.ms']
    var sHour = sqlDateArr3[0];
    var sMinute = sqlDateArr3[1];
    var sSecond = sqlDateArr3[2];

    return new Date(sYear,sMonth,sDay,sHour,sMinute,sSecond);
}

function DateSQLToJsDate(sqlDate){

    //sqlDate in SQL DATETIME format ("yyyy-mm-dd hh:mm:ss.ms")
    var sqlDateArr1 = sqlDate.split("-");
    //format of sqlDateArr1[] = ['yyyy','mm','dd hh:mm:ms']
    var sYear = sqlDateArr1[0];
    var sMonth = (Number(sqlDateArr1[1]) - 1).toString();
    var sDay = sqlDateArr1[2];



    return new Date(sYear,sMonth,sDay);
}

function wildSearch(str, rule) {
    return new RegExp("^" + rule.split("*").join(".*") + "$").test(str);
}
var meLeisuresResize = function(){

    var bg = $("#leisures-bg");
    var text = $("#leisures-text");

    var padText = parseInt(text.css('padding-bottom'));
    var newHeight = text.outerHeight(true);
    bg.height(newHeight);

};

var openCloseMenu = function(closedFromOutside){
  closedFromOutside = closedFromOutside || false;
  console.log('Launched');
  console.log(closedFromOutside);

    var button = $('#hamburger');
    var menu = $('#unroll');
    var mainMenu = $('nav');
    var link = $('#unroll a');

    if (button.hasClass('active') || menu.hasClass('active') || closedFromOutside){
        button.removeClass('active');
        mainMenu.removeClass('active');
        menu.removeClass('active');
    }
    else{
        button.addClass('active');
        mainMenu.addClass('active');
        menu.addClass('active');
    }
};

//Menu open/close responsive
$(function () {

});


ctrl.controller('ChallengesCtrl', ['$scope',
    '$http',
    '$rootScope','$sce',
    function ($scope, $http, $rootScope, $sce) {


    }]);
ctrl.controller('ContactCtrl', ['$scope',
    '$http',
    '$rootScope','$sce',
    function ($scope, $http, $rootScope, $sce) {
        $rootScope.footer = "Une animation viendra dynamiser le tout !";

        $scope.reset = {
            name: '',
            email: '',
            subject: '',
            mail: ''
        };

        $scope.send = function () {
            $http({
                method: "POST",
                url: $rootScope.rootUrl+"/php/sendMail.php",
                data: $.param($scope.maildata),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            }).then(
                function (data) {
                    var response = data.data;
                    if (response.success) {
                        $scope.maildata = angular.copy($scope.reset);
                        $scope.response = response.success;
                    }
                    else{
                        $scope.response = response.error;
                    }
                },
                function (data) {
                    $scope.response = "Soucis technique, le mail est même pas arrivé jusqu'au serveur, la loose";
                });
        };

    }]);
ctrl.controller('MainCtrl', ['$scope',
    '$state',
    '$http', '$rootScope', '$filter',
    function ($scope, $state, $http, $rootScope, $filter) {
        $scope.lines = [];
        $scope.stations = [];
        $scope.problems = [];
        $scope.pbType = [];
        $scope.form = {};
        $scope.form.msg = "";

        $scope.p = {
            type: "",
            line: "",
            station: ""
        };

        $scope.submitProblem = function () {

            var p = $scope.p;
            var date = new Date();
            date = date.getUTCFullYear() + '-' +
                ('00' + (date.getUTCMonth() + 1)).slice(-2) + '-' +
                ('00' + date.getUTCDate()).slice(-2) + ' ' +
                ('00' + date.getUTCHours()).slice(-2) + ':' +
                ('00' + date.getUTCMinutes()).slice(-2) + ':' +
                ('00' + date.getUTCSeconds()).slice(-2);
            var pb = {
                date: date,
                problem_type_id: p.type,
                station_id: p.station,
                line_id: p.line,
                utilisateur_id: $rootScope.loggedUser.id
            };

            $http({
                method: "POST",
                url: $rootScope.rootUrl + "/php/addProblem.php",
                data: $.param(pb),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            }).then(
                function (data) {
                    $scope.form.msg = data.data.msg;
                    if (data.data.success)
                        $scope.getDatas();
                },
                function () {
                    $scope.response = "Soucis technique";
                });

            $scope.getDatas();
        };

        $scope.problemFormCheck = function () {
            var p = $scope.p;
            $scope.p.disabled = !(p.line !== "" && p.station !== "" && p.type !== "");
        };

        $scope.stationSelect = function () {
            $scope.selectedLine = $filter('filter')($scope.lines, {id: $scope.p.line})[0];
            $scope.problemFormCheck();
        };

        $scope.getDatas = function () {
            $http.get($rootScope.rootUrl + '/php/getLine.php')
                .then(
                    //SUCCESS
                    function (data) {

                        $scope.lines = data.data;
                    },
                    //ERROR
                    function (data) {
                    });
            $http.get($rootScope.rootUrl + '/php/getProblemsType.php')
                .then(
                    //SUCCESS
                    function (data) {
                        $scope.pbType = data.data;
                    },
                    //ERROR
                    function (data) {
                    });
            $http.get($rootScope.rootUrl + '/php/getProblems.php')
                .then(
                    //SUCCESS
                    function (data) {
                        //Formattage des dates SQL vers JS
                        angular.forEach(data.data, function (p) {
                            p.line = "Ligne "+ p.line;
                            p.date = DatetimeToJsDate(p.date)
                        });
                        $scope.problems = data.data;
                    },
                    //ERROR
                    function (data) {
                    });
            $http.get($rootScope.rootUrl + '/php/getStations.php')
                .then(
                    //SUCCESS
                    function (data) {
                        $scope.stations = data.data;
                    },
                    //ERROR
                    function (data) {
                    });
        };

        $scope.getDatas();
        $scope.problemFormCheck();
    }]);

ctrl.controller('ProfileCtrl', ['$scope',
    '$state',
    '$http','$rootScope',
    function ($scope, $state, $http, $rootScope) {

    if($state.current.name === "profile")
        $state.go("profile.manage");


}]);

ctrl.controller('ProfileEditCtrl', ['$scope',
    '$state',
    '$http', '$rootScope',
    function ($scope, $state, $http, $rootScope) {

        var u = $rootScope.loggedUser;

        $scope.user = {
            pseudo: u.pseudo,
            email: u.email,
            tel: u.tel,
            passwd: "",
            verifpasswd: ""
        };
        $scope.form = {
            pseudo: "",
            email: "",
            tel: "",
            passwd: "",
            verifpasswd: "",
            disabled: true,
            msg: "",
            pA: false,
            eA: false
        };

        var checklogins = function (isP, str) {
            var check = {
                email: (!isP) ? str : undefined,
                pseudo: (isP) ? str : undefined
            };
            $http({
                method: "POST",
                url: $rootScope.rootUrl + "/php/checkif.php",
                data: $.param(check),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            }).then(
                function (data) {
                    if (isP)
                        $scope.form.pA = data.data.pseudoAvailable;
                    else
                        $scope.form.eA = data.data.mailAvailable;
                },
                function () {
                    $scope.response = "Soucis technique";
                });

        };

        $scope.checkForm = function () {
            var e = $scope.user;
            var f = $scope.form;
            var isPassNew = (e.passwd !== undefined && e.passwd !== "");
            //  console.log(isPassNew + " " + e.passwd);
            var a = false;


            if (e.pseudo !== undefined && e.pseudo.length >= 3) {
                f.pseudo = "";
                if (e.pseudo !== u.pseudo) {
                    checklogins(true, e.pseudo);
                    if (f.pA)
                        f.pseudo = "Le pseudo est disponible";
                    else {
                        a = true;
                        f.pseudo = "Le pseudo est déjà pris.";
                    }
                }
                else
                    f.pseudo = "";
            }
            else {
                a = true;
                f.pseudo = "Le pseudo est trop court";
            }


            if (e.pseudo !== undefined && e.email.length >= 6) {
                f.email = "";
                if (e.email !== u.email) {
                    checklogins(false, e.email);
                    if (f.pA)
                        f.pseudo = "L'adresse mail est disponible";
                    else {
                        a = true;
                        f.pseudo = "L'adresse mail est déjà prise.";
                    }
                }
                else f.email = "";
            }
            else {
                a = true;
                f.email = "L'adresse est trop courte pour être correcte.";
            }


            if (isPassNew) {
                if (e.passwd.length >= 6) {
                    f.passwd = "";
                    if (e.passwd === e.verifpasswd) {
                        f.passwd = "";
                        f.verifpasswd = "";
                    }
                    else {
                        a = true;
                        f.verifpasswd = f.passwd = "Les mots de passe ne correspondent pas";
                    }
                }
                else {
                    a = true;
                    f.passwd = "Le mot de passe est trop court."
                }
            }
            else {
                f.passwd = "";
            }
            f.disabled = a;
            $scope.form = f;
        };

        $scope.updateProfile = function () {
            var u = $scope.user;
            var update = {
                id: $rootScope.loggedUser.id,
                pseudo: u.pseudo,
                email: u.email,
                tel: u.tel,
                passwd: (u.passwd !== undefined && u.passwd !== "") ? u.passwd : null
            };

            $http({
                method: "POST",
                url: $rootScope.rootUrl + "/php/updateProfile.php",
                data: $.param(update),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            }).then(
                function (data) {
                    $scope.form.msg = data.data.msg;
                    if (data.data.success) {
                        $rootScope.loggedUser.pseudo = data.data.user.p;
                        $rootScope.loggedUser.email = data.data.user.e;
                        $rootScope.loggedUser.tel = data.data.user.t;
                        if (update.passwd !== null)
                            $rootScope.loggedUser.password = data.data.user.password;
                    }
                },
                function () {
                    $scope.response = "Soucis technique";
                });


        };

        $scope.checkForm();
    }]);

ctrl.controller('SigninCtrl', ['$scope',
    '$http',
    '$rootScope', '$state', '$cookies',
    function ($scope, $http, $rootScope, $state, $cookies) {

        $scope.user = {
            pseudo: "",
            email: "",
            tel: "",
            passwd: "",
            verifpasswd: ""
        };
        $scope.form = {
            pseudo: "",
            email: "",
            tel: "",
            passwd: "",
            passverif: "",
            disabled: true,
            msg: ""
        };
        $scope.signin = function () {
            $http({
                method: "POST",
                url: $rootScope.rootUrl + "/php/inscription.php",
                data: $.param($scope.user),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            }).then(
                function (data) {

                    $scope.form = data.data;
                    if (data.data.success) {
                        $cookies.put('newuser', $scope.user.pseudo);
                        $state.go("main.signup");
                    }
                },
                function () {
                    $scope.response = "Soucis technique";
                });
        };

        $scope.checkForm = function () {
            $scope.form.passverif = ($scope.user.passwd == $scope.user.verifpasswd) ? "" : "Les mots de passe ne correspondent pas";
            $scope.form.passwd = ($scope.user.passwd != undefined && $scope.user.passwd.length >= 6 ) ? "" : "Mot de passe trop court";

            $scope.form.pseudo = ($scope.user.pseudo != undefined && $scope.user.pseudo.length > 3) ? "" : "Votre pseudo est trop court.";
            $scope.form.email = ($scope.user.email != undefined && $scope.user.email.length > 3) ? "" : "Veuillez renseigner une adresse mail conforme.";

            $scope.form.disabled = ($scope.form.passverif.length > 0
                && $scope.form.passwd.length > 0
                && $scope.form.pseudo.length > 0
                && $scope.form.email.length > 0);
        }


    }]);
ctrl.controller('SignupCtrl', ['$scope',
    '$http',
    '$rootScope', '$cookies', '$state',
    function ($scope, $http, $rootScope, $cookies, $state) {

        $scope.user = {
            pseudo: "",
            passwd: "",
            rememberme: false
        };

        $scope.form = {
            pseudo: "",
            passwd: ""
        };

        var newsign = $cookies.get('newuser');
        $scope.user.pseudo = (newsign !== undefined) ? newsign : "";


        $scope.signup = function () {
            $http({
                method: "POST",
                url: $rootScope.rootUrl + "/php/connexion.php",
                data: $.param($scope.user),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            }).then(
                function (data) {
                    $scope.form = data.data.form;

                    if (data.data.success) {
                        if ($scope.user.rememberme) {
                            var remember = {
                                i: data.data.user.id,
                                h: data.data.user.password
                            };
                            $cookies.putObject('remember', remember);
                        }
                        $rootScope.loggedUser = data.data.user;
                        $rootScope.logged = true;
                        $state.go("main");
                    }

                },
                function () {
                    $scope.response = "Soucis technique";
                });
        };


        $scope.checkform = function () {
            $scope.form.pseudo = ($scope.user.pseudo !== undefined && $scope.user.pseudo.length < 3) ? "Le pseudo est trop court pour être correct" : "";
            $scope.form.passwd = ($scope.user.passwd !== undefined && $scope.user.passwd.length < 6) ? "Le mot de passe est trop court pour être correct" : "";

            $scope.form.disabled = ($scope.form.pseudo > 0 && $scope.form.passwd > 0);
        }


    }]);