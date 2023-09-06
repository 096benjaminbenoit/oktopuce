import Logo from '../components/Logo';

export default class Routes {

  apply(router) {

    router.setPwaSchema({
      "name": "Oktopuce",
      "short_name": "OTP",

      // Possible values ltr(left to right)/rtl(right to left) #optional
      "dir": "ltr",

      // language: Default en-US #optional
      "lang": "fr-FR",
      "icons": [
            {
              "src": Logo,
              "sizes": "192x192"
            }
            // You may add more size if you want to, but it is optional
          ]
    });
    
    // ..code
    // router.hooks.initRoutes.tap...
  }
}