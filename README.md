# hello-docker

Sample Laravel Project, packed into a docker container

Docker container will be build on GitHub actions

# Based on:

* https://codefresh.io/docs/docs/learn-by-example/php/
* https://event-driven.io/en/how_to_buid_and_push_docker_image_with_github_actions/

# Running

docker login ghcr.io

- use personal access token with packages:read

- run (the key is just an example)

    `docker run -p 8080:80 -e LOG_CHANNEL=stderr -e APP_KEY=base64:UNf2jEVGO5aPvECHsTum71g+mO0ACrfB4LWlb5akTA4= ghcr.io/addismap/hello-docker:latest`

