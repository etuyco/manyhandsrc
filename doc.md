# Registration Tag System Documentation

## Overview

The Registration Tag System is a Vue.js plugin that allows you to embed registration forms directly into program and event descriptions using simple HTML tags. This system automatically converts `<registration>` tags into interactive registration forms.

## How It Works

### 1. Backend Setup

The system uses Laravel models and controllers to handle registration data:

**Models:**
- `Registration.php` - Stores registration submissions
- `Program.php` - Has a `content` field for HTML content with registration tags
- `Event.php` - Has a `content` field for HTML content with registration tags

**Controllers:**
- `RegistrationController.php` - Handles form submissions via API
- `ProgramController.php` - Manages programs with content field
- `EventController.php` - Manages events with content field

**Database:**
- `registrations` table stores all form submissions
- Programs and events have a `content` field that can contain HTML with `<registration>` tags

### 2. Frontend Vue.js System

The frontend uses a custom Vue directive and plugin system:

**Key Files:**
- `registrationPlugin.js` - Main plugin that processes registration tags
- `RegistrationForm.vue` - The actual form component
- `ProgramDetail.vue` - Displays programs with registration directive
- `EventDetail.vue` - Displays events with registration directive

## Usage Guide

### Adding Registration Forms to Content

1. **In the Admin Panel:**
   - Navigate to Programs or Events section
   - Edit the program/event you want to add a registration form to
   - In the "Content" field, add `<registration></registration>` where you want the form to appear
   - Example:
     ```html
     <p>This is a great program for community members.</p>
     
     <registration></registration>
     
     <p>Contact us for more information.</p>
     ```

2. **The form will automatically appear** when users view the program/event detail page

### Advanced Usage with Attributes

You can customize the registration form behavior using attributes:

```html
<!-- Basic registration form -->
<registration></registration>

<!-- Registration form without age field -->
<registration show-age="false"></registration>

<!-- Registration form with emergency contact field -->
<registration show-emergency-contact="true"></registration>

<!-- Registration form with both customizations -->
<registration show-age="false" show-emergency-contact="true"></registration>
```

### Available Attributes

| Attribute | Type | Default | Description |
|-----------|------|---------|-------------|
| `show-age` | boolean | `true` | Show/hide the age selection field |
| `show-emergency-contact` | boolean | `false` | Show/hide emergency contact fields |

## Technical Implementation

### Vue Directive

The system uses a custom Vue directive `v-registration` that:

1. **Parses HTML content** for `<registration>` tags
2. **Extracts attributes** from the tags for customization
3. **Replaces tags** with Vue component instances
4. **Mounts components** dynamically in the correct locations

### Plugin Registration

In `app.js`:
```javascript
import RegistrationPlugin from './plugins/registrationPlugin';
Vue.use(RegistrationPlugin);
```

### Component Usage

In detail pages:
```vue
<div v-registration="{ type: 'program', itemId: program.id }" v-html="formatContent(program.content)"></div>
```

### Form Data Structure

Registration forms collect the following data:

```javascript
{
  type: 'program' | 'event',          // What they're registering for
  item_id: number,                    // ID of the program/event
  first_name: string,                 // Required
  last_name: string,                  // Required
  email: string,                      // Required
  phone: string,                      // Required
  age_group: string,                  // Optional, shown by default
  emergency_contact_name: string,     // Optional, hidden by default
  emergency_contact_phone: string,    // Optional, hidden by default
  message: string                     // Optional
}
```

### API Endpoints

- `POST /api/registrations` - Submit a new registration
- `GET /api/programs/{id}` - Get program details with content
- `GET /api/events/{id}` - Get event details with content

## File Structure

```
resources/js/
├── components/
│   ├── RegistrationForm.vue        # The registration form component
│   ├── ProgramDetail.vue           # Program detail page with directive
│   ├── EventDetail.vue             # Event detail page with directive
│   └── AdminPanel.vue              # Admin interface for content editing
├── plugins/
│   └── registrationPlugin.js       # Main plugin logic
└── app.js                          # Plugin registration

app/
├── Http/Controllers/
│   └── RegistrationController.php  # API controller for submissions
├── Models/
│   ├── Registration.php            # Registration model
│   ├── Program.php                 # Program model with content field
│   └── Event.php                   # Event model with content field

database/migrations/
└── create_registrations_table.php  # Database schema
```

## Admin Interface

### Content Editing

The admin panel provides a user-friendly interface for adding registration tags:

1. **Content Field** - HTML textarea for entering content
2. **Instructions** - Clear guidance on how to use registration tags
3. **Preview** - See how the content will appear with registration forms

### Registration Management

View and manage registration submissions:
- Filter by program/event
- Export registration data
- View submission details

## Styling and Appearance

The registration forms use Bootstrap classes for consistent styling:
- Responsive design that works on all devices
- Form validation with error messages
- Loading states during submission
- Success messages after completion

## Error Handling

The system includes comprehensive error handling:

**Frontend:**
- Form validation before submission
- Network error handling
- User-friendly error messages

**Backend:**
- Input validation and sanitization
- Database error handling
- API error responses

## Debugging

Enable console logging by checking the browser developer tools:

1. Open Developer Tools (F12)
2. Go to Console tab
3. Look for registration-related messages:
   - "Registration directive binding"
   - "Parsing registration tags"
   - "Found registration tags in content"

## Best Practices

1. **Content Structure** - Place registration tags where they make logical sense in your content
2. **Testing** - Always test registration forms after adding them
3. **Backup** - Keep backups of content before making changes
4. **Validation** - Ensure all required form fields are properly configured

## Troubleshooting

### Common Issues

**Registration form not showing:**
- Check console for JavaScript errors
- Verify the `<registration>` tag is properly formatted
- Ensure the content field contains the tag

**Form submission errors:**
- Check network tab for API errors
- Verify all required fields are filled
- Check server logs for backend errors

**Styling issues:**
- Ensure Bootstrap CSS is properly loaded
- Check for CSS conflicts
- Verify responsive design on different devices

### Getting Help

If you encounter issues:
1. Check the browser console for error messages
2. Verify the content contains proper registration tags
3. Test with a simple `<registration></registration>` tag first
4. Check that the Vue plugin is properly loaded

## Future Enhancements

Potential improvements to consider:
- Additional form field types
- Custom validation rules
- Email notifications for submissions
- Integration with external services
- Advanced form analytics