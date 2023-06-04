import { useState } from 'react';
import axios from 'axios';

axios.defaults.withCredentials = true;
axios.defaults.headers.common['Accept'] = 'application/json';

function App() {
  const [isFetching, setIsFetching] = useState(false);
  const [error, setError] = useState('');
  const [status, setStatus] = useState('');
  const [account, setAccount] = useState({});
  const [data, setData] = useState({});

  const fetchHOF = async (fetchPromise, readData=true) => {
    setIsFetching(true);
    try {
      const res = await fetchPromise;
      setStatus(res.status);
      setData(res.data);
    } catch (err) {
      setError(err);
    }
    setIsFetching(false);
  };

  const handleFetchXsrfToken = async () => {
    await fetchHOF(axios.get('http://localhost:8000/sanctum/csrf-cookie'));
  };

  const handleChangeAccount = (field) => (evt) => {
    setAccount({
      ...account,
      [field]: evt.target.value
    });
  };

  const handleGetGejalas = async () => {
    await fetchHOF(axios.get('http://localhost:8000/api/gejalas'));
  };

  const handleLogin = async () => {
    if (account.email && account.password) {
      await fetchHOF(axios.post('http://localhost:8000/login', {
        email: account.email,
        password: account.password
      }));
    }
  };

  const handleLogout = async () => {
    await fetchHOF(axios.post('http://localhost:8000/logout'));
  };

  const handleCreateToken = async () => {
    await fetchHOF(axios.post('http://localhost:8000/tokens/create'));
  };

  return (
    <div style={{ display: 'flex', flexDirection: 'row' }}>
      <div style={{ flex: 1 }}>
        <dl>
          <dt>Error</dt>
          <dd>{String(error)}</dd>
        </dl>
        <dl>
          <dt>Status</dt>
          <dd>{status}</dd>
        </dl>
        <dl>
          <dt>Data</dt>
          <dd style={{ wordBreak: 'break-all' }}>{JSON.stringify(data)}</dd>
        </dl>
      </div>
      <div style={{ flex: 1, display: 'flex', flexDirection: 'column', alignItems: 'flex-start' }}>
        <button onClick={handleFetchXsrfToken}>{isFetching ? 'Fetching...' : 'Fetch xsrf token'}</button>
        <label>Name: <input type="text" onChange={handleChangeAccount('name')} /></label>
        <label>Email: <input type="email" onChange={handleChangeAccount('email')} /></label>
        <label>Password: <input type="password" onChange={handleChangeAccount('password')} /></label>
        <label>Password Confirmation: <input type="password" onChange={handleChangeAccount('password_confirmation')} /></label>
        <button onClick={handleLogin}>{isFetching ? 'Fetching...' : 'Login'}</button>
        <button onClick={handleGetGejalas}>{isFetching ? 'Fetching...' : 'Get api/gejalas'}</button>
        <button onClick={handleLogout}>{isFetching ? 'fetching...' : 'Logout'}</button>
        <button onClick={handleCreateToken}>{isFetching ? 'fetching...' : 'Create Token'}</button>
      </div>
    </div>
  )
}

export default App
