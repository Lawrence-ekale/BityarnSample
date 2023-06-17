import axios from 'axios';

const API_BASE_URL = 'http://127.0.0.1/locations_backend/MainFile.php';//http://127.0.0.1/kimurgor_backend/MainFile.php


class BackendService{
    getLocation(data) {
        return axios.post(API_BASE_URL,data);
    }
    getWard(data) {
        return axios.post(API_BASE_URL, data);
    }
    getSubCounty(data) {
        return axios.post(API_BASE_URL, data);
    }
    getCounty(data) {
        return axios.post(API_BASE_URL, data);
    }

    getLevels(data) {
        return axios.post(API_BASE_URL, data);
    }
    getLevelsSub(data) {
        return axios.post(API_BASE_URL,data);
    }


}

export default new BackendService();