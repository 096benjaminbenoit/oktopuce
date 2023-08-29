/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';


import React, { useReducer } from 'react';
import { LoginContext, LoginDispatchContext } from './context/LoginContext';
import { createRoot } from 'react-dom/client';
import { RouterProvider, createBrowserRouter } from 'react-router-dom';
import {
  QueryClient,
  QueryClientProvider,
  useQuery,
} from '@tanstack/react-query';


import Home from './pages/Home';
import Connexion from './pages/Connexion';
import ClimpropreUI from './pages/ClimpropreUI';
import ScanPage from './pages/ScanPage';
import Error404 from './pages/Error404';
import InfosUser from './pages/InfosUser';
import Site from './pages/Site';
import Equipement from './pages/ChoixEquipement';
import SiteList from './pages/SiteList';
import ProductInfo from './pages/ProductInfo'


// Create the router

const router = createBrowserRouter([
  {
    path: "/",
    element: <Home />,
    errorElement: <Error404 />,
  },
  {
    path: "/login",
    element: <Connexion />,
  },
  {
    path: "/scan",
    element: <ScanPage />,
  },
  {
    path: "/equipment/:nfcTag",
    element: <ClimpropreUI />,
  },
  {
    path: "/clim-info",
    element: <ProductInfo/>,
  },
  {
    path: "/infos",
    element: <InfosUser />,
  },
  {
    path: "/site",
    element: <Site />,
  },
  {
    path: "/choixEquipement",
    element: <Equipement />,
  },
  {
    path: "/error404",
    element: <Error404 />,
  },
  {
    path: "/siteslist",
    element: <SiteList />,
  }
]);

// Clear the existing HTML content
document.body.innerHTML = '<div id="app"></div>';
// Render your React component instead
const root = createRoot(document.getElementById('app'));
root.render(<React.StrictMode>
  <App />
</React.StrictMode>);


const queryClient = new QueryClient()


function App() {
  const [login, loginDispatch] = useReducer(loginReducer, { loggedIn: false });

  return (
    <QueryClientProvider client={queryClient}>
      <LoginContext.Provider value={login}>
        <LoginDispatchContext.Provider value={loginDispatch}>
          <RouterProvider router={router} />
        </LoginDispatchContext.Provider>
      </LoginContext.Provider>
    </QueryClientProvider>
  );
}


function loginReducer(login, action) {
  switch (action.type) {
    case 'login': {
      return {
        token: action.token,
        loggedIn: true,
      };
    }
    case 'logout': {
      return { loggedIn: false };
    }
    default: {
      throw Error('Unknown action: ' + action.type);
    }
  }
}