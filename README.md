# hello-docker

Sample Laravel Project, packed into a docker container

Docker container will be built on GitHub actions

1. Builts the container
2. Executes tests via [Robo Task runnter](https://robo.li/)
3. Pushes the image with a test prefix, for all branches, even if tests fail
4. If all tests pass, pushes to :latest
5. 
# Based on:

* https://codefresh.io/docs/docs/learn-by-example/php/
* https://event-driven.io/en/how_to_buid_and_push_docker_image_with_github_actions/

# Running

docker login ghcr.io

- use personal access token with packages:read

- run (the key is just an example)

    `docker run -p 8080:80 -e LOG_CHANNEL=stderr -e APP_KEY=base64:UNf2jEVGO5aPvECHsTum71g+mO0ACrfB4LWlb5akTA4= ghcr.io/addismap/hello-docker:latest`

# Use in your own project

1. Copy the following files to your Laravel 9 project
   ```
   .github/workflows/build-and-publish.yml
   phpstan.neon
   phpcs.xml
   Dockerfile
   docker-compose.yml
   docker-compose.dev.yml
   RoboFile.php
   ```
2. Execute
   ```
   composer require --dev squizlabs/php_codesniffer nunomaduro/larastan staabm/annotate-pull-request-from-checkstyle
   ```
   
3. Adapt `.github/workflows/build-and-publish.yml`: Replace `addismap/hello-docker` by your own project name
4. Enable GitHub Actions and set secrets (at `https://github.com/USERNAME/PROJECTNAME/settings/secrets/actions`):
    1. `DOCKERHUB_USERNAME` - your dockerhub username (for pulling the images)
    2. `DOCKERHUB_TOKEN` - your dockerhub token (for pulling the images)
    3. `GHCR_PAT` - [Github Personal Access Token](https://github.com/settings/tokens) with `write:packages`, `repo` scopes 

   




