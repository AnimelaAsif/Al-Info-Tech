#!/bin/bash
marker="<!-- INSERT_IMAGES_HERE -->"
excluded_files=("iata.png" "logo.png")

# Array to hold filenames from images-list.txt
declare -a filenames_from_list

# Read filenames from images-list.txt into the array
while IFS= read -r filename; do
    filenames_from_list+=("$(basename "$filename")")
done < images-list.txt

# Iterate through each line in images.html
while IFS= read -r line; do
    # Check if the line contains an image filename
    filename=$(echo "$line" | grep -oE 'src="([^"]+)"' | cut -d'"' -f2)
    if [ -n "$filename" ]; then
        # Check if the filename is not in the filenames_from_list array
        if ! [[ " ${filenames_from_list[@]} " =~ " $(basename "$filename") " ]]; then
            # Remove the line from images.html
            sed -i "/$line/d" images.html
            echo "Removed line: $line from images.html"
        fi
    fi
done < images.html

# Iterate through images-list.txt and add images to images.html if they are not already present
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

