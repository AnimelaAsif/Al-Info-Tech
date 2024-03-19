#!/bin/bash
files=$(ls | grep -E '\.jpg$|\.png$|\.jpeg$|\.JPG$')
echo "$files" > images-list.txt
echo "File names written to images.txt"