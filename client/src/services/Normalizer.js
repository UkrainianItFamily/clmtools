export const userMapper = user => ({
    id: user.id,
    name: user.name,
    lastName: user.last_name,
    email: user.email,
    phone: user.phone,
    verified: user.email_verified_at,
});

export const emptyUser = () => ({
    id: null,
    name: '',
    lastName: '',
    email: '',
    phone: '',
});
