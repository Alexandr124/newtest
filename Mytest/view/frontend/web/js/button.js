define(['jquery', 'underscore', 'uiRegistry', 'Magento_Ui/js/form/components/button',
        'Magento_Ui/js/form/form'],
       function ($, _, uiRegistry, button) {
           var mydata = uiRegistry.get("funnyorder_form.funnyorder_form_data_source");

           return button.extend({
                                    defaults: {
                                        elementTmpl: 'ui/form/element/mybutton',
                                    },
                                    action: function () {
                                        $.ajax({
                                                   type: "POST",
                                                   url: "/newmagento/vaimo_mytest/savefunnyorder/index",
                                                   data: mydata.data
                                               })
                                    }
                                });
       });
