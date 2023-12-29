package com.springboot.restfullwebservice.repository;


import com.springboot.restfullwebservice.Enitity.Surat;
import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface SuratRepository extends JpaRepository<Surat, Long> {
    List<Surat> findByUserId(Long userId);

}