package com.springboot.restfullwebservice.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.springboot.restfullwebservice.Enitity.Kaos;
import com.springboot.restfullwebservice.Enitity.PaymentKaos;
import com.springboot.restfullwebservice.Enitity.User;
import com.springboot.restfullwebservice.repository.PaymentKaosRepository;

import java.util.List;

@Service
public class PaymentKaosService {

    private final PaymentKaosRepository paymentKaosRepository;

    @Autowired
    public PaymentKaosService(PaymentKaosRepository paymentKaosRepository) {
        this.paymentKaosRepository = paymentKaosRepository;
    }

    public PaymentKaos createPaymentKaos(PaymentKaos paymentKaos) {
        return paymentKaosRepository.save(paymentKaos);
    }

    public List<PaymentKaos> getAllPaymentKaos() {
        return paymentKaosRepository.findAll();
    }

    public List<PaymentKaos> getPaymentByUserId(Long userId) {
        return paymentKaosRepository.findByUserId(userId);
    }

    // Tambahkan fungsi lainnya sesuai kebutuhan aplikasi Anda

}
