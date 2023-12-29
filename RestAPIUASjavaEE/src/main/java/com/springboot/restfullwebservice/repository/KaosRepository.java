package com.springboot.restfullwebservice.repository;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.springboot.restfullwebservice.Enitity.Kaos;

@Repository
public interface KaosRepository extends JpaRepository<Kaos, Long> {
}
