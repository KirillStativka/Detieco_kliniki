ymaps.ready(init);

function init () {
    var myCollection = new ymaps.GeoObjectCollection();
    var myMap = new ymaps.Map('map', {
            center: [55.76, 37.64],
            zoom: 5
        }, {
            searchControlProvider: 'yandex#search'
        }),
        objectManager = new ymaps.ObjectManager({
            clusterize: true,
            gridSize: 32
        });

    objectManager.objects.options.set('preset', 'islands#darkGreenDotIcon');
    objectManager.clusters.options.set('preset', 'islands#darkGreenClusterIcons');
    myMap.geoObjects.add(objectManager);

    $.ajax({
        type: "POST",
        data: {
            action: 'yandex_map_city',
            nonce: map.nonce,
            city_id: map.city_id,
            type: map.type,
            physical: map.physical,
            psyho: map.psyho,
        },
        url: map.ajax_url
    }).done(function(data) {
        objectManager.add(data);
       // myMap.geoObjects.add( myCollection );
        myMap.setBounds( objectManager.getBounds(), {checkZoomRange: true} );
    });

}