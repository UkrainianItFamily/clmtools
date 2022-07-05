import requestService from '@/services/request-service/ApiRequestService';

const statusService = {
  async getStatusByService(serviceName) {
    const response = await requestService.get(`/status/${serviceName}`);

    return response?.data?.data?.[0];
  }
};

export default statusService;
