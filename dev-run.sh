#!/bin/bash
DOCKER_USER="$(id -u):$(id -g)" docker-compose -f docker-compose.yml -f docker-compose.dev.yml up
