/**
 * Created by sascha on 6/20/2016.
 */

ymaps.ready(init);

var lat = 55.76,
    lng = 37.64,
    objectManager;

function getKey(coords) {
    var key = '';
    coords.forEach(function (v) {
        var ltd = '' + v[0];
        var lng = '' + v[1];
        ltd = ltd.split('.');
        ltd = ltd[0] + '.' + ltd[1].slice(0, 6);
        lng = lng.split('.');
        lng = lng[0] + '.' + lng[1].slice(0, 6);
        key += ltd + lng;
    });
    return key;
}

function showPlaces(myMap) {
    var coords = myMap.getBounds(),
        key = getKey(coords);

    var cacheData = localStorage.getItem(key);

    if (cacheData) {
        objectManager.removeAll();
        objectManager.add(JSON.parse(cacheData));
    }
    else {
        $.ajax({
            url: "/places",
            data:
            'min_latitude=' + coords[0][0] +
            '&max_latitude=' + coords[1][0] +
            '&min_longitude=' + coords[0][1] +
            '&max_longitude=' + coords[1][1] +
            '&zoom=' + myMap.getZoom() +
            '&map_width=' + parseInt(document.querySelector('#map').style.width) +
            '&map_height=' + parseInt(document.querySelector('#map').style.height),
            cache: false
        }).done(function(data) {
            objectManager.removeAll();
            localStorage.setItem(key, JSON.stringify(data));
            objectManager.add(data);
        });
    }
}

function init () {
    var myMap = new ymaps.Map('map', {
            center: [lat, lng],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        });

    objectManager = new ymaps.ObjectManager({
        // clustering
        clusterize: true,
        gridSize: 32
    });


    objectManager.objects.options.set('preset', 'islands#greenDotIcon');
    objectManager.clusters.options.set('preset', 'islands#greenClusterIcons');
    myMap.geoObjects.add(objectManager);

    showPlaces(myMap);

    myMap.events.add('boundschange', function (event) {
        showPlaces(myMap);
    });

}
