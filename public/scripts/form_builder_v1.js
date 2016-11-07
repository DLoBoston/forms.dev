$(document).ready(function() {
  
    //// GLOBAL ------------------------------------
    
    var form_elements = [];
		var current_form_element; // If applicable, what form element the user is working with
    var current_form_data = passthrough_form_data; // init_form_data comes from html template
    
    //// CUSTOM OBJECTS ------------------------------------
    
    // Form Element
    var FormElement = function (id, type, order, label, default_value, required, guidelines) {
      this.id = id;
      this.type = type;
      this.order = order;
      this.label = label;
      this.default_value = default_value;
      this.required = required;
      this.guidelines = guidelines;
    };
      // Method associated with FormElement (as delineated by 'prototype') to get generic form element HTML
      FormElement.prototype.getGenericHtml = function(id, type, order, label, default_value, required, guidelines) {
        return		'<div class="form-group">'
								+		'<div data-form-element-id="' + id + '"'
								+			' data-form-element-type="' + type + '"'
								+			' data-form-element-order="' + order + '"'
								+			' data-form-element-label="' + label + '"'
								+			' data-form-element-default-value="' + default_value + '"'
								+			' data-form-element-guidelines="' + guidelines + '"'
								+			' data-form-element-required="' + required + '">'
								+			'<p><span class="element-label">' + label + '</span>'
								+					'<span class="element-type"> (' + type + ')</span></p>'
								+		'</div>'
								+		'<p><a data-form-element-action="delete">delete</a></p>'
								+	'</div>';
      };
    
    //// ONLOAD EVENTS ------------------------------------

    // Display current form elements
    for (var i = 0; i < current_form_data.elements.length; i++) {
      addFormElement(current_form_data.elements[i].form_element_id,
                        current_form_data.elements[i].type,
                        current_form_data.elements[i].order,
                        current_form_data.elements[i].label,
                        current_form_data.elements[i].default_value,
                        current_form_data.elements[i].required,
                        current_form_data.elements[i].guidelines);
    };

    // Setup handler - form element toolbox buttons
    $("#element-toolbox").children("button").click(function() {
			// Get next order value by getting length of existing elements and adding 1
			order = ++$("div[data-form-element-id]").length;
			// Add form element to DOM
      addFormElement('', $(this).data("form-element-type"), order, 'NEW ELEMENT', '', 0, '');
    });

    // Setup handler - form delete button. Adds hidden field and then submits form
    $("#btnDelete").click(function() {
      $("#frmBuilder").prepend('<input type="hidden" name="_METHOD" value="DELETE"/>').submit();
    });

    // Setup handler - Clicking on any DOM element other than "form elements" clears the property window
		temp = $("#frmBuilder").children().not("#form-elements").click(function(event) {
			$("aside#element-properties").hide();
		});

    // Setup handler - on builder submission. Serialize form_elements and store in hidden field to send back in request for processing
    $("#frmBuilder").submit(function(event) {
      // Capture FormElement(s) from markup
      $("div[data-form-element-id]").each(function() {
        form_elements.push(new FormElement($(this).data("form-element-id"),
                                            $(this).data("form-element-type"),
                                            $(this).data("form-element-order"),
                                            $(this).data("form-element-label"),
                                            $(this).data("form-element-default-value"),
                                            $(this).data("form-element-required"),
                                            $(this).data("form-element-guidelines")));
      });
      // JSON encode and place in hidden var
      $("input[name='form_elements']").val(JSON.stringify(form_elements));
    });
		
		// Make form-elements container sortable
		$("#form-elements").sortable({
			stop: function(event, ui) {
				// Reset order attribute on all form elements
				resetOrderAttributeOnFormElements();
			}
		});
		
		// Setup handler - Element properties toolbox - Update label display and value
		$("#propertyLabel").keyup(function () {
			$(current_form_element).data('form-element-label', $(this).val());
			$(current_form_element).find("span.element-label").text($(this).val()); // Update label displayed to user
		});
		
		// Setup handler - Element properties toolbox - Update default value
		$("#propertyDefaultValue").keyup(function () {
			$(current_form_element).data('form-element-default-value', $(this).val());
		});
		
		// Setup handler - Element properties toolbox - Update guidelines value
		$("#propertyGuidelines").keyup(function () {
			$(current_form_element).data('form-element-guidelines', $(this).val());
		});
		
		// Setup handler - Element properties toolbox - Update required value
		$("[name='propertyRequired']").change(function () {
			$(current_form_element).data('form-element-required', $(this).prop('checked'));
		});
    
    //// FUNCTIONS ------------------------------------
    
    // Function to add a new form element to the DOM
    function addFormElement(id, type, order, label, default_value, required, guidelines) {
      // Add generic form element html to dom
      $("#form-elements").append(FormElement.prototype.getGenericHtml(id, type, order, label, default_value, required, guidelines));
      // Add show form element properties event handler
      $("div[data-form-element-id]").last().click(showFormElementProperties);
      // Add delete link event handler
      $("a[data-form-element-action='delete']").last().click(handlerFormElementDeleteLink);
    }
		
		// Function to show form element properties toolbox
		function showFormElementProperties(event) {
			current_form_element = $(event.target).closest("div[data-form-element-id]");
			$("aside#element-properties").find("#propertyLabel").val($(current_form_element).data('form-element-label'));
			$("aside#element-properties").find("#propertyDefaultValue").val($(current_form_element).data('form-element-default-value'));
			$("aside#element-properties").find("#propertyGuidelines").val($(current_form_element).data('form-element-guidelines'));
			$("aside#element-properties").find("[name='propertyRequired']").prop('checked', $(current_form_element).data('form-element-required'));
			$("aside#element-properties").show();
		}
    
    // Function to reset the order attribute on all form elements given their position in the DOM
    function resetOrderAttributeOnFormElements() {
			var i = 1;
			$("div[data-form-element-id]").each(function() {
				$(this).data("form-element-order", i);
				i++;
			});
    }
    
    // Function to setup delete element link
    function handlerFormElementDeleteLink(event) {
      // Prevent default link action
      event.preventDefault();
      // Remove element from DOM
      $(this).closest("div.form-group").remove();
			// Hide Element Properties Toolbox
			$("aside#element-properties").hide();
			// Reset order attribute on all form elements
			resetOrderAttributeOnFormElements();
    }
	
});