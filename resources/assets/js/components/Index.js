import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import Header from './Header';
import Footer from './Footer';
import Login from './Login';

export default class Index extends Component {
    render() {
        return (
            <div className="container">
                <div className="jumbotron">
                    <Header />
                        <Login />
                    <Footer />
                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Index />, document.getElementById('app'));
}
