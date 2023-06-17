# Locations

This template should help get you started developing with Vue 3 in Vite.

# PHP Files

In the folder called BackendPHPFiles you will change it's directory to where the php files are served to the server.
The database used is MySQL and in the MyConfigdb.php you have to set your database configurations as per your own.
For Windows/Linux users this folder can be placed in 
```sh
/lampp/htdocs/
```
### Database
In the database you create Five tables.
1. countries Table (country_id, country_name)
2. counties Table (county_id, county_name, country_id->FK)
3. sub_counties Table (sub_county_id,sub_county_name,county_id->FK)
4. ward Table (ward_id,ward_name,sub_county_id->FK)
5. locations Table (location_id,location_name,ward_id->FK)

# GUI
The UI is simple just to showcase how you can navigate by first selecting the level you are or you want to start with, then with the given list you can select the option you know then finally from that option you might decide to check upward(if in ward then select which country, county) or downwards by selecting which locations are under that ward.

Follow the below instructions in order to set up your vuejs frontend project.

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=Vue.volar) (and disable Vetur) + [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=Vue.vscode-typescript-vue-plugin).

## Customize configuration

See [Vite Configuration Reference](https://vitejs.dev/config/).

## Project Setup

```sh
npm install
```

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Compile and Minify for Production

```sh
npm run build
```
