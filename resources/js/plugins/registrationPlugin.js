import Vue from 'vue';
import RegistrationForm from '../components/RegistrationForm.vue';

export default {
    install(Vue) {
        // Register the registration form component globally
        Vue.component('RegistrationForm', RegistrationForm);
        
        // Create a directive to parse registration tags
        Vue.directive('registration', {
            bind(el, binding) {
                console.log('Registration directive binding', { el, binding });
                parseRegistrationTags(el, binding.value);
            },
            update(el, binding) {
                console.log('Registration directive updating', { el, binding });
                parseRegistrationTags(el, binding.value);
            }
        });
    }
};

function parseRegistrationTags(element, context) {
    // Defensive check for context
    if (!context || typeof context !== 'object') {
        console.error('Registration directive requires context object with type and itemId');
        return;
    }
    
    const { type, itemId } = context;
    
    if (!type || !itemId) {
        console.error('Registration directive requires type and itemId in context');
        return;
    }
    
    console.log('Parsing registration tags in:', element.innerHTML);
    
    // First, let's look for registration tags in the HTML content
    const htmlContent = element.innerHTML;
    
    if (htmlContent.includes('<registration>')) {
        console.log('Found registration tags in content');
        
        // Use a more robust approach to find and replace registration tags
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = htmlContent;
        
        // Find all <registration> tags (including self-closing ones)
        const registrationRegex = /<registration[^>]*\/?>/gi;
        let updatedHTML = htmlContent;
        
        let match;
        while ((match = registrationRegex.exec(htmlContent)) !== null) {
            console.log('Found registration tag:', match[0]);
            
            // Create a unique placeholder
            const placeholder = `<div class="registration-form-placeholder" data-registration-id="${Date.now()}"></div>`;
            updatedHTML = updatedHTML.replace(match[0], placeholder);
        }
        
        // Update the element's content
        element.innerHTML = updatedHTML;
        
        // Now find all placeholders and replace with Vue components
        const placeholders = element.querySelectorAll('.registration-form-placeholder');
        placeholders.forEach(placeholder => {
            // Create Vue instance for this registration form
            new Vue({
                el: placeholder,
                render(h) {
                    return h(RegistrationForm, {
                        props: {
                            type: type,
                            itemId: itemId,
                            options: {
                                showAge: true,
                                showEmergencyContact: true
                            }
                        }
                    });
                }
            });
        });
    }
}

// Utility function to process HTML content with registration tags
export function processRegistrationTags(htmlContent, type, itemId) {
    if (!htmlContent || typeof htmlContent !== 'string') {
        return htmlContent;
    }
    
    // Simple regex to find registration tags
    const registrationRegex = /<registration([^>]*)\/?>/gi;
    
    let processedContent = htmlContent;
    let match;
    
    while ((match = registrationRegex.exec(htmlContent)) !== null) {
        const fullTag = match[0];
        const attributes = match[1] || '';
        
        // Parse attributes
        const showAge = !attributes.includes('show-age="false"');
        const showEmergencyContact = attributes.includes('show-emergency-contact="true"');
        
        // Create a placeholder div that will be processed by the directive
        const placeholder = `<div class="registration-placeholder" 
            data-type="${type}" 
            data-item-id="${itemId}" 
            data-show-age="${showAge}" 
            data-show-emergency-contact="${showEmergencyContact}">
            <registration${attributes}></registration>
        </div>`;
        
        processedContent = processedContent.replace(fullTag, placeholder);
    }
    
    return processedContent;
}