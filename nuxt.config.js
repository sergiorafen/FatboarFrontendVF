
export default {
  mode: 'universal',
  /*
  ** Headers of the page
  */
  head: {
    title: process.env.npm_package_name || '',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ],
    script: [
      { src: 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js' }
    ]
  },
  /*
  ** Customize the progress-bar color
  */
  loading: { color: '#fff' },
  /*
  ** Global CSS
  */
  css: [
  ],
  /*
  ** Plugins to load before mounting the App
  */
  plugins: [

  ],
  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
  ],
  /*
  ** Nuxt.js modules
  */
  
  /*
  ** Build configuration
  */
    build: {
        /*
      ** Run ESLint on save
      */
    extend (config, { isDev, isClient }) {
      if (isDev && isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }
    }
    },
    modules: [
      // Doc: https://bootstrap-vue.js.org
      'bootstrap-vue/nuxt','@nuxtjs/axios',
      'cookie-universal-nuxt','@nuxtjs/auth'
    ],
    axios: {
      baseURL: 'http://127.0.0.1:8000/'
    },
    auth: {
      localStorage: false,
      cookie: {
        prefix: 'auth_fatboar.',
        options: {
          path: '/',
          maxAge: 10800
        },
        secure:true
      },
      strategies: {
        facebook: {
          client_id: '1060290161021024',
          scope: ['id', 'email', 'name','hometown','birthday']
        },
        local: {
          endpoints: {
            login: { url: 'login_check', method: 'post', propertyName: 'token' },
            user: { url: 'apitest', method: 'get',propertyName:'user'},
            registerFB: { url: 'api/users', method: 'post', propertyName: 'data.user' },
            logout: false
          },
          // tokenRequired: false,id,name,email,hometown,birthday
          // tokenType: false
        }
      }
    }
}
