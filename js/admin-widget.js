/* 
 * Jquery for Widget
 *
 * @author im00
 * @package Cot
 */

/*
 * jQuery Repeatable Fields v1.4.8
 * http://www.rhyzz.com/repeatable-fields.html
 *
 * Copyright (c) 2014-2015 Rhyzz
 * License MIT
 */
!function(a){a.fn.repeatable_fields=function(b){function e(b){a(d.wrapper,b).each(function(b,c){var g=this,h=a(g).children(d.container);a(h).children(d.template).hide().find(":input").each(function(){a(this).prop("disabled",!0)});var i=a(h).children(d.row).filter(function(){return!a(this).hasClass(d.template.replace(".",""))}).length;if(a(h).attr("data-rf-row-count",i),a(g).on("click",d.add,function(b){b.stopImmediatePropagation();var c=a(a(h).children(d.template).clone().removeClass(d.template.replace(".",""))[0].outerHTML);a(c).find(":input").each(function(){a(this).prop("disabled",!1)}),"function"==typeof d.before_add&&d.before_add(h);var g=a(c).show().appendTo(h);"function"==typeof d.after_add&&d.after_add(h,g,f),e(g)}),a(g).on("click",d.remove,function(b){b.stopImmediatePropagation();var c=a(this).parents(d.row).first();"function"==typeof d.before_remove&&d.before_remove(h,c),c.remove(),"function"==typeof d.after_remove&&d.after_remove(h)}),d.is_sortable===!0&&"undefined"!=typeof a.ui&&"undefined"!=typeof a.ui.sortable){var j=null!==d.sortable_options?d.sortable_options:{};j.handle=d.move,a(g).find(d.container).sortable(j)}})}function f(b,c){var e=a(b).attr("data-rf-row-count");e++,a("*",c).each(function(){a.each(this.attributes,function(a,b){this.value=this.value.replace(d.row_count_placeholder,e-1)})}),c.attr("data-short",e-1),a(b).attr("data-rf-row-count",e),d.after_row_count_change()}function g(){}var c={wrapper:".wrapper",container:".container",row:".row",add:".add",remove:".remove",move:".move",template:".template",is_sortable:!0,before_add:null,after_add:f,before_remove:null,after_remove:null,sortable_options:null,row_count_placeholder:"{{row-count-placeholder}}",after_row_count_change:g},d=a.extend({},c,b);e(this)}}(jQuery);

jQuery(document).ready(function($) {
    $(document).on('panelsopen', function(e) {
        var name = '#' + $(".repeat").data('name');
        var valueHolder = $(name);
        var dom_holder = $(".repeat .container");

        jQuery('.repeat').each(function() {
            jQuery(this).repeatable_fields();
        });
    });
});
