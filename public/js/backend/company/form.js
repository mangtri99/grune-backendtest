$(function(){
    $('#company-form').validationEngine('attach', {
        promptPosition : 'topLeft',
        scroll: false
    });
    
    // init: show tooltip on hover
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
})
