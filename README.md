## Raft

A Docker extension to assist in web applications development.
- Easily set up a proxy, so that you can have multiple applications (virtual hosts).
  - Different domains are routed to different applications running in your machine.

Roadmap:
- Configure virtual hosts
- Set up local SSL certificates.
  - Not only you're mimicking the production environment, you can now also develop SSL-only browser API features.

### Concept

Currently, only Traefik is supported as reverse proxy. Maybe we can add more in the future.

There are 2 ways to register virtual hosts:
- Use your local containers in the "web" network, and add labels so that Traefik discovers configuration.
  - Those labels are: 
- Add a config file in your home folder: (to be continued)

### Architecture

Basically, the extension's UI is a redirect to a full stack app, that is declared in the extension's vm.
This is a Laravel application, with the Livewire library and achieves the following goals: 
- Display the UI
- Manage persistence
  - Publish/edit configuration files
  - Manage data in a sqlite database
- Run Docker commands (it has the `/var/run/docker.sock` mapped, and `docker-cli` installed.)
