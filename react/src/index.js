import React from 'react';
import ReactDOM from 'react-dom';
import { Router, Route, hashHistory } from 'react-router';
import 'bootstrap/dist/css/bootstrap.css';
import 'font-awesome/css/font-awesome.css';
import 'todomvc-app-css/index.css';
import './index.scss';

import { Provider } from "react-redux";

import store from './store';

//import [Domain] from './Domain/[main.js]';
import MyTodo from './MyTodo/MyTodo';

ReactDOM.render((
    <Provider store={store}>
        <Router history={hashHistory}>
            <Route path="/" component={MyTodo}/>
        </Router>
    </Provider>
), document.getElementById('root'));
