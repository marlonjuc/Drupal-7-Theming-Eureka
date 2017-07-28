##Eureka theme Sass/Gulp implementation
This theme uses Gulp as a task manager and sass to compile the .scss files to standard css.

###Installation
To use the tools you need to:

- Install Node.js
`https://nodejs.org/download/release/v5.9.1/`

- Install gulp running:
`npm install -g gulp`

- Go to /sites/all/themes/eureka and run:
`npm install`

- Run `gulp build` in the command line to compile the sass file.

- Run `gulp` to have the watch process waiting to compile on each file save.

With the below process you will have a watcher waiting for changes in your sass files and it will compile to css everytime you save. 