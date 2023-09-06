import PwaIcon192 from "./resources/images/path-to-pwa-icon-192x192.png";
import PwaIcon512 from "./resources/images/path-to-pwa-icon-512x512.png";

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
              "src": OktopuceLogo,
              "sizes": "192x192"
            }
            // You may add more size if you want to, but it is optional
          ]
    });
    
    // ..code
    // router.hooks.initRoutes.tap...
  }
}