# Stripe Payment Integration Setup

This document explains how to set up Stripe payments for the donation feature.

## What's Included

### Backend (Laravel)
- **Stripe PHP SDK**: `stripe/stripe-php` package installed
- **Payment Intent API**: Creates secure payment intents for processing donations
- **DonationController**: Enhanced with Stripe payment processing
- **Database Integration**: Stores donation records with payment details

### Frontend (Vue.js)
- **Stripe Elements**: Secure payment form with `@stripe/stripe-js`
- **Two-step Process**: 
  1. Donation form (donor details + amount)
  2. Secure payment processing with Stripe Elements
- **Enhanced UX**: Quick amount selection buttons, payment summary, loading states

## Setup Instructions

### 1. Get Stripe API Keys
1. Create a Stripe account at https://stripe.com
2. Get your API keys from the Stripe Dashboard:
   - Publishable key (starts with `pk_`)
   - Secret key (starts with `sk_`)

### 2. Configure Environment Variables
Update your `.env` file with your Stripe keys:

```env
STRIPE_KEY=pk_test_your_publishable_key_here
STRIPE_SECRET=sk_test_your_secret_key_here
MIX_STRIPE_KEY="${STRIPE_KEY}"
```

### 3. Build the Frontend
Run the build command to compile the Stripe integration:
```bash
npm run dev
```

## Features

### Security
- **PCI Compliance**: Stripe Elements handles sensitive payment data
- **Payment Intent**: Secure two-step payment process
- **Server Validation**: All payments verified server-side

### User Experience
- **Quick Amounts**: Pre-set donation buttons ($25, $50, $100, $250)
- **Custom Amounts**: Users can enter any amount
- **Payment Summary**: Clear breakdown before payment
- **Progress Indicators**: Loading states and success/error messages
- **Responsive Design**: Works on all devices

### Payment Flow
1. User fills donation form (name, email, amount, message)
2. System creates a Payment Intent with Stripe
3. User enters payment details in secure Stripe Elements form
4. Payment is processed and confirmed
5. Donation record is saved to database
6. Success confirmation is displayed

## Testing

Use Stripe's test card numbers:
- **Success**: 4242 4242 4242 4242
- **Declined**: 4000 0000 0000 0002
- **Requires SCA**: 4000 0025 0000 3155

## Database Schema

The `donations` table includes:
- `payment_method`: "stripe"
- `payment_status`: "completed" 
- `transaction_id`: Stripe Payment Intent ID
- All donor information and donation details

## API Endpoints

- `POST /api/donations/payment-intent`: Create payment intent
- `POST /api/donations`: Save completed donation

## Error Handling

- Network errors
- Payment failures
- Validation errors
- Server errors

All errors are displayed to users with helpful messages.

## Production Deployment

1. Replace test keys with live Stripe keys
2. Update webhook endpoints if using Stripe webhooks
3. Test with real payment methods
4. Monitor transactions in Stripe Dashboard