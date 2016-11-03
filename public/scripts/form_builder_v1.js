$(document).ready(function() {
  
    //// GLOBAL ------------------------------------
    
    var form_elements = [];
    var current_form_data = passthrough_form_data; // init_form_data comes from html template
    
    //// CUSTOM OBJECTS ------------------------------------
    
    // Form Element
    var FormElement = function (id, type, order, label) {
      this.id = id;
      this.type = type;
      this.order = order;
      this.label = label;
    };
      // Method associated with FormElement to get generic form element HTML
      FormElement.prototype.getGenericHtml = function(id = '', type = '', order = 0, label = '') {
        return		'<div class="form-group">'
								+		'<div data-form-element-id="' + id + '"'
								+			'data-form-element-type="' + type + '"'
								+			'data-form-element-order="' + order + '"'
								+			'data-form-element-label="' + label + '">'
								+				label
								+				' (' + type + ')'
								+			' | <a data-form-element-action="delete">delete</a>'
								+		'</div>'
								+	'</div>';
      };
    
    //// ONLOAD EVENTS ------------------------------------

    // Display current form elements
    for (var i = 0; i < current_form_data.elements.length; i++) {
      addFormElement(current_form_data.elements[i].form_element_id,
                        current_form_data.elements[i].type,
                        current_form_data.elements[i].order,
                        current_form_data.elements[i].label);
    };

    // Setup handler - form element toolbox buttons
    $("#element-toolbox").children("button").click(function() {
      addFormElement(id = '', type = $(this).data("form-element-type"));
    });

    // Setup handler - form delete button. Adds hidden field and then submits form
    $("#btnDelete").click(function() {
      $("#frmBuilder").prepend('<input type="hidden" name="_METHOD" value="DELETE"/>').submit();
    });

    // Setup handler - clicking on form elements
		$("div[data-form-element-id]").click(function() {
      $("aside#element-properties").show();
    });

    // Setup handler - Clicking on any DOM element other than "form elements" clears the property window
		$("form").children().not("div#form-elements").click(function() {
      $("aside#element-properties").hide();
    });

    // Setup handler - on builder submission. Serialize form_elements and store in hidden field to send back in request for processing
    $("#frmBuilder").submit(function(event) {
      // Capture FormElement(s) from markup
      $("div[data-form-element-id]").each(function() {
        form_elements.push(new FormElement($(this).data("form-element-id"),
                                            $(this).data("form-element-type"),
                                            $(this).data("form-element-order"),
                                            $(this).data("form-element-label")));
      });
      // JSON encode and place in hidden var
      $("input[name='form_elements']").val(JSON.stringify(form_elements));
    });
		
		// Make form-elements container sortable
		$("#form-elements").sortable({
			stop: function(event, ui) {
				// Reset order attribute on all elements based on new position
				var i = 0;
				$("div[data-form-element-id]").each(function() {
					$(this).data("form-element-order", i);
					i++;
				});
			}
		});
    
    //// FUNCTIONS ------------------------------------
    
    // Function to add a new form element to the DOM
    function addFormElement(id = '', type = 'text', order = 0, label = 'NEW ELEMENT') {
      // Add generic form element html to dom
      $("#form-elements").append(FormElement.prototype.getGenericHtml(id, type, order, label));
      // Add delete link event handler
      $("a[data-form-element-action='delete']").last().click(event, handlerFormElementDeleteLink);
    }
    
    // Function to setup delete element link
    function handlerFormElementDeleteLink(event) {
      // Prevent default link action
      event.preventDefault();
      // Remove element from DOM
      $(this).parent().remove();
    }
	
});