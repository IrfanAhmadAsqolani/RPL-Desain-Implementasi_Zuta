import React, { Component } from 'react';

import Header from 'parts/Header';
import Herosection from 'parts/Herosection';

export default class LandingPage extends Component {
  render() {
    return (
      <>
        <Header></Header>
        <Herosection></Herosection>
      </>
    );
  }
}
