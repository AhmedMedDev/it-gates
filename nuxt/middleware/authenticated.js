import axios from 'axios';
export default async function ({ route, redirect }) {
  const accessToken = localStorage.getItem('access_token');

  if (!accessToken) {
    return redirect('/auth/login');
  }
  
  try {
    await axios.post(
      `http://127.0.0.1:8000/api/auth/me`,
      {},
      {
        headers: {
          Authorization: `Bearer ${accessToken}`,
        },
      }
    );
  } catch (error) {
    return redirect('/auth/login');
  }
}
