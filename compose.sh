#!/bin/bash

if [ ! -f "${0%/*}/.env" ]; then
    if [ -f "${0%/*}/.env.example" ]; then
        cp "${0%/*}/.env.example" "${0%/*}/.env"
    fi
fi

docker compose up -d
