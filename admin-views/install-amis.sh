#!/bin/bash

if [ -z "$1" ]; then
    echo "Usage: $0 <version>"
    exit 1
fi

pnpm i amis@$1 amis-core@$1 amis-editor@$1 amis-editor-core@$1 amis-ui@$1
