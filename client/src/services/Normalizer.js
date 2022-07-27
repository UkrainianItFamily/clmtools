export const userMapper = user => ({
    id: user.id,
    avatar: user.avatar ? user.avatar : '/img/empty_avatar.jpg',
    name: user.name,
    lastName: user.last_name,
    email: user.email,
    phone: user.phone,
    dateBirth: user.date_birth,
    city: user.city,
    university: user.university,
    graduationYear: user.graduation_year,
    verified: user.email_verified_at,
    lecturer: user.lecturer,
});

export const emptyUser = () => ({
    id: null,
    avatar: '/img/empty_avatar.jpg',
    name: '',
    lastName: '',
    email: '',
    phone: '',
    verified: '',
    lecturer: false,
    dateBirth: null,
    city: '',
    university: '',
    graduationYear: '',
});
