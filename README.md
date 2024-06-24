

## User management app (create/edit with permissions via roles/rules)
Laravel + Inertia + VueJS

Key functionality:

- both guests and authenticated users can view the contents of users.index page (lists all users)
- authorized users can create/edit users (based on their roles and established rules)


### Notes
> - persistent layouts (via defineOptions())
> - default layout (defined in app.js)
> - optional preserve-scroll (Link attr)
> - preserve state on request (search watcher via router options)
> - history replace on request (router options)
> - pagination preserve query string (via Laravel's withQueryString() on paginator)
> - use of Inertia form helper (see resources/js/Pages/Users/Create.vue)
> - use of route() to form url for the Link href attribute (e.g. :href="route('users.edit', {id: user.id}) for the named "/users/{user}/edit" endpoint)
> - provide JS components with user's permissions via Laravel's policies "can/cannot" helpers
