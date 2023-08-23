/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import { createContext, useReducer } from 'react';
import { LoginContext, LoginDispatchContext } from './context/LoginContext';

import React from 'react';
import { createRoot } from 'react-dom/client';
import Home from './pages/Home';
import Connexion from './pages/Connexion';
import ScanPage from './pages/ScanPage';
import Error404 from './pages/Error404';
import Informations from './pages/Informations';
import { RouterProvider, createBrowserRouter } from 'react-router-dom';
import FormInformations from './components/FormInformations';
// Create the router

const router = createBrowserRouter([
  {
    path: "/",
    element: <Home />,
  },
  {
    path: "/login",
    element: <Connexion />,
  },
  {
    path: "/scan",
    element: <ScanPage />,
  }
]);

// Clear the existing HTML content
document.body.innerHTML = '<div id="app"></div>';
// Render your React component instead
const root = createRoot(document.getElementById('app'));
root.render(<React.StrictMode>
  <App />
</React.StrictMode>);

function App() {

  const [login, loginDispatch] = useReducer(loginReducer, {loggedIn: false});

  return (
    <LoginContext.Provider value={login}>
      <LoginDispatchContext.Provider value={loginDispatch}>
        <RouterProvider router={router} />
      </LoginDispatchContext.Provider>
    </LoginContext.Provider>
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
      return {loggedIn: false};
    }
    default: {
      throw Error('Unknown action: ' + action.type);
    }
  }
}