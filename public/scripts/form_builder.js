$(document).ready(function() {
  
    //// GLOBAL VARS ------------------------------------
    
    // HTML for empty form element
    var htmlEmptyFormElement = '<div class="form-group">' +
                                  '<div data-form-element-id=""' +
                                       'data-form-element-type=""' +
                                       'data-form-element-label="">' +
                                     'NEW ELEMENT' +
                                     ' | <a data-form-element-action="delete">delete</a>' +
                                  '</div>' +
                                '</div>';
    
    //// ON LOAD EVENTS ------------------------------------

    // Setup add form element button
    $("#btnAddElement").click(function() {
      addFormElementToDom();
    });

    // Setup form delete button
    $("#btnDelete").click(function() {
      $("#frmBuilder").prepend('<input type="hidden" name="_METHOD" value="DELETE"/>').submit();
    });

    // Setup delete links on existing form elements
    $("a[data-form-element-action='delete']").click(event, handlerFormElementDeleteLink);

    // Store initial form elements in javascript
    var form_elements = [];
    $("div[data-form-element-id]").each(function() {
      form_elements.push(new FormElement($(this).data("form-element-id"),
                                          $(this).data("form-element-label"),
                                          $(this).data("form-element-label")));
    });

    // On builder submission, serialize form_elements and store in hidden field
    $("#frmBuilder").submit(function(event) {
      $("input[name='form_elements']").val(JSON.stringify(form_elements));
    });
    
    //// FUNCTIONS ------------------------------------
	
    // Form element constructor
    function FormElement(id, type, label) {
      this.id = id;
      this.type = type;
      this.label = label;
    }
    
    // Function to add a new form element to the DOM
    function addFormElementToDom() {
      $("#btnAddElement").parent().before(htmlEmptyFormElement);
      $("a[data-form-element-action='delete']").last().click(event, handlerFormElementDeleteLink);
    }
    
    // Function to setup delete element link
    function handlerFormElementDeleteLink(event) {
      // Prevent default link action
      event.preventDefault();
      // Remove element from javascript storage
      for (var i = 0; i < form_elements.length; i++) {
        if (form_elements[i].id === $(this).parent().data("form-element-id")) {
          form_elements.splice(i,1);
        }
      }
      // Remove element from DOM
      $(this).parent().remove();
    }
	
});