export const userMapper = user => ({
    id: user.id,
    name: user.name,
    lastName: user.last_name,
    email: user.email,
    phone: user.phone,
});

export const emptyUser = () => ({
    id: null,
    name: '',
    lastName: '',
    email: '',
    phone: '',
});
