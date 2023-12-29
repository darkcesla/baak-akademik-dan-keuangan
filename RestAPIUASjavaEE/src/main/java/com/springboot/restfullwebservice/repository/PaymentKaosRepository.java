package com.springboot.restfullwebservice.repository;
import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.springboot.restfullwebservice.Enitity.PaymentKaos;

@Repository
public interface PaymentKaosRepository extends JpaRepository<PaymentKaos, Integer> {
    List<PaymentKaos> findByUserId(Long userId);
}
