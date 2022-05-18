/* eslint-disable */
import axios from 'axios';
import {baseURL} from '../constants';
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

const API = axios.create({
    baseURL,
    headers: {
        "Content-type": "application/json",
    }
});

export default API;