#!/bin/sh
# delete first underscore (between year and month)
for D in $(find * -mindepth 1 -maxdepth 1 -type d) ; do
	rename 's\_\\' $D;
done
# delete second underscore (between month and day)
for D in $(find * -mindepth 1 -maxdepth 1 -type d) ; do
	rename 's\_\\' $D;
done
# delete prewievs
find . -name '*n.jpg' -delete


for album in */*; do
	echo "$album";

	# Execute every directory in its own shell, so we do not need to worry
	# about "cd -" on errors, etc.
	(
	cd "$album";

	# Fill the positional parameter array with all files. "*" is expanded
	# alphabetically by default.
	set -- *;

	# First, determine the number of digits to use for the zero-padded
	# number.
	num_digits=4;
	
	# Rename all files.
	i=0;
	for file; do
		let i++;

		new_file="$(printf "%0${num_digits}d.%s" $i "${file##*.}")";
		# Unless they already have the right name.
		[ "$new_file" = "$file" ] && continue;

		# Make sure to ask before overwriting, and be verbose about the operation.
		mv -vi "$file" "$new_file";
	done;
	);
done;

