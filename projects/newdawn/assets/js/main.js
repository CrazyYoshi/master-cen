var app = angular.module('NewDawn',
    ['ui.router', 'ngAnimate','ngSanitize', 'ngTouch', 'newDawnCtrl']);

app.config(function ($stateProvider, $urlRouterProvider, $locationProvider) {

    $urlRouterProvider.otherwise("home");
    $locationProvider.html5Mode(true);
    $stateProvider
        .state('home', {
            controller: 'HomeCtrl',
            url: "/home",
            templateUrl: "assets/partials/home.html"
        })
        .state('thetrail', {
            controller: 'TheTrailCtrl',
            url: "/thetrail",
            templateUrl: "assets/partials/thetrail.html"
        })
        .state('skill', {
            controller: 'SkillCtrl',
            url: "/skill",
            templateUrl: "assets/partials/skill.html"
        })
        .state('experience', {
            controller: 'ExperienceCtrl',
            url: "/experience",
            templateUrl: "assets/partials/experience.html"
        })
        .state('leisure', {
            controller: 'LeisureCtrl',
            url: "/leisure",
            templateUrl: "assets/partials/leisure.html"
        })
        .state('contact', {
            controller: 'ContactCtrl',
            url: "/contact",
            templateUrl: "assets/partials/contact.html"
        });

});

app.run(['$rootScope', function( $rootScope) {
 // $rootScope.rootUrl = "http://cvbidon.lan";
 $rootScope.rootUrl = "https://cen.newdawn.amnesia.cafe";
 // $rootScope.rootUrl = "http://projets.html.css.free.fr/maamar-miloud-15610768";
}]);

var ctrl = angular.module('newDawnCtrl', []);








ctrl.controller('ContactCtrl', ['$scope',
    '$http',
    '$rootScope','$sce',
    function ($scope, $http, $rootScope, $sce) {
        $rootScope.footer = "J'ai pas de 06... sorry. <<Tout ce que l'on aime devient une fiction.>> " +
            "Je sais pas qui a dit ça mais j'aquiesce. Désolé je délire.. ";

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

ctrl.controller('ExperienceCtrl', ['$scope',
    '$http','$rootScope',
    function ($scope, $http, $rootScope) {

        $rootScope.footer = "Autant dire que j'avais la flemme de lister mes experience et de michtonner dessus...";

        $scope.experiences = "";
        $http.get($rootScope.rootUrl+'/php/returnExperience.php')
            .then(
                //SUCCESS
                function (data) {
                    console.log(data);
                    $scope.experiences = data.data;
                },
                //ERROR
                function (data) {
                });

        $scope.openedIndex = -1;
        $scope.open = function ($index) {
            if ($scope.openedIndex != $index)
                $scope.openedIndex = $index;
            else
                $scope.openedIndex = -1;
        };
    }]);
/**
 * Created by Miloud on 21/12/2016.
 */

ctrl.controller('HomeCtrl', ['$scope',
    '$state',
    '$http','$rootScope',
    function ($scope, $state, $http, $rootScope) {



        $rootScope.footer = "BLUE BIRD";
        $scope.infos = "";
        $http.get($rootScope.rootUrl+'/php/returnInfos.php')
            .then(
                //SUCCESS
                function (data) {
                    $scope.infos = data.data[0];
                },
                //ERROR
                function (data) {
                });
        $rootScope.$state = $state;
}]);

ctrl.controller('LeisureCtrl' , ['$scope',
    '$http','$rootScope',
    function ($scope, $http,$rootScope) {

        $rootScope.footer = "C'est la dernière page faite, j'ai vraiment eu la flemme de la faire. J'ai vraiment hésiter à la virer quand j'ai vu que j'avais oublier le parcours.";

        $scope.leisures = "";
        $http.get($rootScope.rootUrl+'/php/returnLeisure.php')
            .then(
                //SUCCESS
                function (data) {
                    $scope.leisures = data.data;
                },
                //ERROR
                function (data) {
                });
    }]);
ctrl.controller('SkillCtrl',
    ['$scope',
        '$http','$rootScope',
        function ($scope, $http,$rootScope) {
            $rootScope.footer = "DES COULEURS !!! HALLELUJAH!!! Oui je sais tout utiliser ;), il y en a meme plus, mais tout est question de flemme et de modestie.";
            $scope.allSkills = "";
            $http.get($rootScope.rootUrl+'/php/returnSkill.php')
                .then(
                    //SUCCESS
                    function (data) {
                        $scope.allSkills = data.data;
                    },
                    //ERROR
                    function (data) {
                    });

            $scope.openedIndex = -1;
            $scope.open = function ($index) {
                if ($scope.openedIndex != $index)
                    $scope.openedIndex = $index;
                else
                    $scope.openedIndex = -1;
            };
        }]);
ctrl.controller('TheTrailCtrl', ['$scope',
    '$http','$rootScope',
    function ($scope, $http,$rootScope) {

        $rootScope.footer = "Je me suis cassé la tête a générer un truc dynamique, actualises pour voir, mais au final, je suis déçu";


        $scope.trails = "";
        $http.get($rootScope.rootUrl+'/php/returnTheTrail.php')
            .then(
                //SUCCESS
                function (data) {
                    $scope.trails = $scope.setTrail(data.data);
                },
                //ERROR
                function (data) {
                });


        $scope.setTrail = function (fulltab) {
            var trailsClasses = {
                first: ' start-trail',
                end: ' end-trail',
                left: ' left-trail',
                right: ' right-trail',
                top: ' top-trail',
                topL: ' left-top-trail',
                topR: ' right-top-trail',
                botL: ' left-bot-trail',
                botR: ' right-bot-trail',
                default: ' trail-params',
                reset: ' trail-params-reset'
            };
            var aIndex = [];
            for (var x in trailsClasses) {
                aIndex.push(x);
            }

            for (var index in fulltab) {
                var classes = "";
                var existPrevElem = ((fulltab[parseInt(index) - 1]) ? true : false);
                var existNextElem = ((fulltab[parseInt(index) + 1]) ? true : false);
                var rand = Math.floor(Math.random() * 2) + 2;
                var newClass = trailsClasses[aIndex[rand]];
                var randNode = Math.floor(Math.random() * 4);
                var nodeColor = " node-col"+randNode;

                if (!existPrevElem) {
                    classes += trailsClasses.first;
                    classes += trailsClasses.left;
                }
                else {
                    var prevElem = fulltab[index - 1];
                    if (prevElem.classes.search(newClass.trim()) > -1) {
                        classes += newClass;
                    }
                    else {
                        classes += newClass;
                        if(prevElem.classes.search(trailsClasses.left) > -1){
                            prevElem.classes += trailsClasses.botL;
                            classes += trailsClasses.topR;
                        }
                        else{
                            prevElem.classes += trailsClasses.botR;
                            classes += trailsClasses.topL;
                        }
/*                        prevElem.classes += trailsClasses.borderBot;
                        classes += trailsClasses.borderTop;*/

                        fulltab[index].liclasses = trailsClasses.default;
                        fulltab[index].liclasses += trailsClasses.reset;
                        fulltab[index].liclasses += trailsClasses.top;
                    }

                    if(!existNextElem){
                        classes += trailsClasses.end;
                    }
                }
                classes += nodeColor;
                fulltab[index].classes = classes;
            }

            return fulltab;

        };

    }]);
