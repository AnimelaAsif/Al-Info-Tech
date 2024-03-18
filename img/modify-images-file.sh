#!/bin/bash
marker="<!-- INSERT_IMAGES_HERE -->"
excluded_files=("iata.png" "logo.png")

declare -a filenames_from_list

while IFS= read -r filename; do
    filenames_from_list+=("$(basename "$filename")")
done < images-list.txt

while IFS= read -r line; do
    filename=$(echo "$line" | grep -oE 'src="([^"]+)"' | cut -d'"' -f2)
    if [ -n "$filename" ]; then
        if ! [[ " ${filenames_from_list[@]} " =~ " $(basename "$filename") " ]]; then
            sed -i "/$line/d" images.html
            echo "Removed line: $line from images.html"
        fi
    fi
done < images.html

while IFS= read -r filename; do
    exclude=false
    for excluded_file in "${excluded_files[@]}"; do
        if [[ "$(basename "$filename")" == "$excluded_file" ]]; then
            exclude=true
            break
        fi
    done
    
    if $exclude; then
        echo "Skipping $(basename "$filename")"
        continue
    fi
   
    if ! grep -q "$(basename "$filename")" images.html; then
       sed -i "/$marker/i\    <div class=\"photo\">\n        <img src=\"$(basename "$filename")\" alt=\"$(basename "$filename" .jpg)\">\n    </div>" images.html
        echo "Added $(basename "$filename") to images.html"
    fi
done < images-list.txt

