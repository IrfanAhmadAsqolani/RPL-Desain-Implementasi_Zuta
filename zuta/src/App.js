import React, { useState } from 'react';
import { BrowserRouter as Router, Route } from 'react-router-dom';
import LandingPage from 'pages/LandingPage';
import LoginPage from 'pages/Login';

import 'assets/scss/style.scss';

function App() {
  // const [token, setToken] = useState();

  // if (!token) {
  //   return <LoginPage></LoginPage>;
  // }

  return (
    <div className="App">
      <Router>
        <Route exact path="/" component={LandingPage} />
        <Route exact path="/login" component={LoginPage} />
      </Router>
    </div>
  );
}

export default App;
