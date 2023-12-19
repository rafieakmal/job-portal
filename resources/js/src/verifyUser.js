async function verifyUser(id) {
    try {
        const user = await axios.post('api/candidate/validation', {
            id
        })

        if (user.data.status === 200) {
            return user.data.data
        } else {
            return false
        }
    } catch (error) {
        console.error(error);
        return error
    }
}

export default verifyUser;