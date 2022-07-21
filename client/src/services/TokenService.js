class TokenService {
    getLocalAccessToken() {
        return localStorage.getItem("auth.access_token");
    }
}
export default new TokenService();
