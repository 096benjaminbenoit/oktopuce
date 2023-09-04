import './styles/admin-app.scss';

import './bootstrap.js';




// $(".vehicule_category").on('change',function(){
//     {% set url = ea_url()
//         .setController('App\\Controller\\App\\VehiculeAppCrudController')
//         .setAction('new') %} // has to be "new" action even for editForm (isXmlHttpRequest is not allowed in Edit, see line 221 in EasyCorp\Bundle\EasyAdminBundle\Controller)

// var data = {};
// data[obj.attr('name')] = $(this).val();
// $.ajax({
//     type: 'POST',
//     url: '{{ url|raw }}',
//     data: data,
//     success: function(html){
//         $('.vehicule_brand').parent().replaceWith($(html).find('.vehicule_brand').parent());
//     }
// });
// return false;
// });