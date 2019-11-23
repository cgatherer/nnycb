#!/bin/bash

# if you need to create new deriviatives from the pngs used in the live lighting tool
# do this on the cli first
# magick mogrify -path ./staticsrc -resize 2000x1120 -quality 100 *.png

# creates files like static/blue_dark-green_orange.jpg in the format TOWER_PIER1_PIER2.jpg
# the generated images must be placed in the website envirnoment's /sites/default/files/static_lighting
# they are NOT commited to the git repo

declare -a colors=("white"
                "pink"
                "purple"
                "blue"
                "blue-green"
                "mint-green"
                "dark-green"
                "green"
                "yellow"
                "orange"
                "dark-orange"
                "red-orange"
                "red"
                )

i=0

for tower in "${colors[@]}"
do
   # or do whatever with individual element of the array
   for pier1 in "${colors[@]}"
   do
      for pier2 in "${colors[@]}"
      do

        base="./staticsrc/white.jpg"
        img1="./staticsrc/towers-${tower}.png"
        img2="./staticsrc/pier1-${pier1}.png"
        img3="./staticsrc/pier2-${pier2}.png"

        outputpath="../../../../sites/default/files/static_lighting"
        output="${outputpath}/${tower}_${pier1}_${pier2}.jpg"

        magick convert $base -quality 50 \
        $img1 -compose Multiply -composite \
        $img2 -compose Multiply -composite \
        $img3 -compose Multiply -composite \
        $output

       ((i=i+1))
      done
   done
done
echo "images created: $i"
