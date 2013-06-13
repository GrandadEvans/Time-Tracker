#Time Tracker

This is the plan so far.
I want this project to be a web based project that will access the local system and will monitor the system for changes in the active window title.

Projects are specified and will be assigned certain keywords.
If one of these keywords is recognised in the active window title, the time will start and the database will be updated.

##Options

I want this to be accessible by both the web portal and the command line.
Obviously this means I want the best of both worlds

I also want a icon in the launcher, this is obviously linux/ubuntu specific but after looking into it other OS may be linked in.


#Plan of action

##What I will be using
Outside sources I will be using

* DataTables
* jQuery
* HTML5BP

Tools I will be using
* Vim (of course)
* Terminator (a multiple terminal emulator)

##Proposed File Tree
<pre>
./
|---non-public/
|   |---bash-handler/
|   |---models/
|   |---config/
|   |   |---config.php
|   |   |---functions.php
|   |   |---prelims.php
|   |---controllers/
|   |---views/
|   |   |---index.php
|---public/
|   |---css/
|   |---js/
|   |---img/
|   |---vendor-specific/
|   |---.htaccess
|   |---index.php
|
</pre>
