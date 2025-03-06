## Description
Calculator done in vue, laravel, inertiajs.
[DEMO](https://vue-calculator-main-sxdgce.laravel.cloud/)

What could be done further:
  1. Add more operations and with that parser to block the string to account for (). Add 3rd level of priority.
  2. Make design responsive utilising tailwind break points.
  3. Clean up session handling.
  4. Possibly refactor form element and break it into components.
  5. Clean up leftover code from laravel vue-starter kit

## Instructions
To run project localy 
```
composer run dev
```
Pre-requisits
[WorkOS Account](https://workos.com/)
```
WORKOS_CLIENT_ID=your-client-id
WORKOS_API_KEY=your-api-key
WORKOS_REDIRECT_URL="${APP_URL}/authenticate"
```
