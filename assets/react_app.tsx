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

// Clear the existing HTML content
document.body.innerHTML = '<div id="app"></div>';

// Render your React component instead
const root = createRoot(document.getElementById('app'));
root.render(<App />);


function App(): React.ReactNode {

  const [login, loginDispatch] = useReducer(loginReducer, {loggedIn: false});

  return <>
    login is {JSON.stringify(login)}
    <LoginContext.Provider value={login}>
      <LoginDispatchContext.Provider value={loginDispatch}>
        <Connexion />
      </LoginDispatchContext.Provider>
    </LoginContext.Provider>
  </>;
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

