package com.bibloteca.clienti.repository;
import com.bibloteca.clienti.entity.Clienti;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.lang.NonNull;
import org.springframework.stereotype.Repository;

import java.util.List;
public interface Clientirepository extends JpaRepository<Clienti, Long> {
    @Query("select b from clienti b where b.email like ?1")
    List<Clienti> FindClientiEmail(@NonNull String email);
}
