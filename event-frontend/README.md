
# Event Management - Front End

Admin Panel for Event Management.


## Demo

https://event.cameomanjachola.com/


## Deployment

To deploy this project run

Download the repo or clone it. Then run this commands. Before check whether nodejs is installed or not.

```bash
  npm install
```

After installing the dependencies, Update .env file (rename .env.example if .env file not exists)

```bash
  VUE_APP_API_URL="Your API Domain"
```

After that run the command
```bash
  npm run build
```

After build, dist folder will be generated. Copy the files inside dist folder and upload to the webserver.

Then Application will be ready to use.


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`VUE_APP_API_URL`

